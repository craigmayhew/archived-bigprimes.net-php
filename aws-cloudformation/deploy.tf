provider "aws" {
  region     = "eu-west-2"
}

resource "aws_cloudformation_stack" "api" {
  capabilities = ["CAPABILITY_IAM"]
  name = "bigprimes-api"
  parameters {
    # replace this with mysql IAM!
    mysqlHost = "mysql.adire.co.uk"
    mysqlUser = "root"
    mysqlPassword = "123456789"
    mysqlDatabase = "bigprimes"
  }
  on_failure = "DELETE"
  template_body = "${ file("api.yml") }"
}
