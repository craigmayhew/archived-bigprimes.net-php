variable "bucket" {
  type = "string"
  default = "bigprimes-created-by-cfterraform"
}

provider "aws" {
  region     = "eu-west-1"
}

resource "null_resource" "build" {
  provisioner "local-exec" {
    command = "cd tools && php build.php"
  }
}

resource "aws_cloudformation_stack" "api" {
  capabilities = ["CAPABILITY_IAM"]
  depends_on = ["aws_cloudformation_stack.lambdas"]
  name = "bigprimes-api"
  on_failure = "DELETE"
  parameters {
    certificateARN = "arn:aws:acm:us-east-1:902420391845:certificate/eb2693d6-fe4a-4f9f-8ce5-d09ae037e627"
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
    mysqlHost = "mysql.adire.co.uk"
    mysqlUser = "root"
    mysqlPassword = "123456789"
    mysqlDatabase = "bigprimes"
    s3Bucket = "${var.bucket}"
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
