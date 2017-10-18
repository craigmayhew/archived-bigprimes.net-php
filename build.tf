resource "null_resource" "build" {
  provisioner "local-exec" {
    command = "cd tools && php build.php"
  }
}

resource "null_resource" "deploy" {
  provisioner "local-exec" {
    command = "cd tools && php uploadToS3.php key=${var.access_key} secret=${var.secret_key}"
  }
}