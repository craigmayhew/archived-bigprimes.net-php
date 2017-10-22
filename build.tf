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
  depends_on = ["null_resource.build","aws_s3_bucket_object.lambda"]
  name = "bigprimes-api"
  on_failure = "DELETE"
  parameters {
    # replace this with mysql IAM!
    mysqlHost = "mysql.adire.co.uk"
    mysqlUser = "root"
    mysqlPassword = "123456789"
    mysqlDatabase = "bigprimes"
    s3Bucket = "bigprimes-created-by-cfterraform"
  }
  template_body = "${ file("cloudformation/api.yml") }"
}

resource "aws_s3_bucket" "b" {
  bucket = "bigprimes-created-by-cfterraform"
  acl    = "private"
}

resource "aws_s3_bucket_object" "lambda" {
  bucket = "${aws_s3_bucket.b.bucket}"
  key    = "lambdas/php.zip"
  source = "/tmp/lambda.zip"
  etag   = "${md5(file("/tmp/lambda.zip"))}"
}
