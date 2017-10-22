provider "aws" {
  region     = "eu-west-2"
}

resource "null_resource" "build" {
  provisioner "local-exec" {
    command = "cd tools && php build.php"
  }
}

resource "aws_cloudformation_stack" "api" {
  capabilities = ["CAPABILITY_IAM"]
  depends_on = ["null_resource.build"]
  name = "bigprimes-api"
  on_failure = "DELETE"
  parameters {
    # replace this with mysql IAM!
    mysqlHost = "mysql.adire.co.uk"
    mysqlUser = "root"
    mysqlPassword = "123456789"
    mysqlDatabase = "bigprimes"
    s3Bucket = "bigprimes"
  }
  template_body = "${ file("cloudformation/api.yml") }"
}
