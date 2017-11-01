variable "bucket" {
  type = "string"
  default = "bigprimes-created-by-cfterraform"
}
variable "rdshost" {type = "string"}
variable "rdsdb" {type = "string"}
variable "rdsuser" {type = "string"}
variable "rdspass" {type = "string"}
variable "securityGroup" {type = "string"}
variable "subnetA" {type = "string"}
variable "subnetB" {type = "string"}
variable "subnetC" {type = "string"}

provider "aws" {
  region     = "eu-west-1"
}

resource "null_resource" "build" {
  depends_on = ["local_file.phpjs"]
  provisioner "local-exec" {
    command = "cd tools && php build.php"
  }
}

resource "local_file" "phpjs" {
  content = <<EOF
process.env['PATH'] = process.env['PATH'] + ':' + process.env['LAMBDA_TASK_ROOT'];

const spawn = require('child_process').spawn;

exports.handler = function(event, context) {
    var php = spawn('php-71-bin/bin/php', ['-c','php-71-bin/php.ini', 'htdocs/index-silex.php'], {
      env: {
        REQUEST_URI: (event.params&&event.params.proxy?'/'+event.params.proxy+'/':''),
        bigprimesDBEndPoint: '${var.rdshost}',
        bigprimesDBName: '${var.rdsdb}',
        bigprimesDBUser: '${var.rdsuser}',
        bigprimesDBPass: '${var.rdspass}'
      }
    });
    var output = '';

    //send the input event json as string via STDIN to php process
    php.stdin.write(JSON.stringify(event));

    //close the php stream to unblock php process
    php.stdin.end();

    //dynamically collect php output
    php.stdout.on('data', function(data) {
          output+=data;
    });

    //react to potential errors
    php.stderr.on('data', function(data) {
            console.log("STDERR: "+data);
    });

    //finalize when php process is done.
    php.on('close', function(code) {
            context.succeed(output);
    });
}
EOF
  filename = "php.js"
}

resource "aws_cloudformation_stack" "api" {
  capabilities = ["CAPABILITY_IAM"]
  depends_on = ["aws_cloudformation_stack.lambdas"]
  name = "bigprimes-api"
  on_failure = "DELETE"
  parameters {
    certificateARN = "arn:aws:acm:us-east-1:902420391845:certificate/4768a8b5-5707-40b8-aece-9f5ba8277097"
    phpLambdaARN = "${aws_cloudformation_stack.lambdas.outputs["LambdaARN"]}"
  }
  template_body = "${ file("cloudformation/api.yml") }"
}

resource "aws_cloudformation_stack" "lambdas" {
  capabilities = ["CAPABILITY_IAM"]
  depends_on = ["null_resource.build","aws_s3_bucket_object.lambda"]
  name = "bigprimes-lambdas"
  on_failure = "DELETE"
  parameters {
    # replace this with mysql IAM!
    mysqlHost = "${var.rdshost}"
    mysqlUser = "${var.rdsuser}"
    mysqlPassword = "${var.rdspass}"
    mysqlDatabase = "${var.rdsdb}"
    s3Bucket = "${var.bucket}"
    securityGroup = "${var.securityGroup}"
    subnetA = "${var.subnetA}"
    subnetB = "${var.subnetB}"
    subnetC = "${var.subnetC}"
  }
  template_body = "${ file("cloudformation/lambdas.yml") }"
}

resource "aws_s3_bucket" "b" {
  bucket = "${var.bucket}"
  acl    = "private"
}

resource "aws_s3_bucket_object" "lambda" {
  bucket = "${aws_s3_bucket.b.bucket}"
  depends_on = ["null_resource.build"]
  key    = "lambdas/php.zip"
  source = "/tmp/lambda.zip"
}
