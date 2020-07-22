variable "vpc_id" {
}

provider "aws" {
  region = "eu-west-1"
}

##############################################################
# Data sources to get VPC, subnets and security group details
##############################################################
data "aws_vpc" "target_vpc" {
  id = var.vpc_id
}

data "aws_subnet_ids" "all" {
  vpc_id = data.aws_vpc.target_vpc.id
}

resource "aws_security_group" "rds" {
  vpc_id = data.aws_vpc.target_vpc.id
  name   = "rds"
  ingress {
    description = "MySQL for all"
    from_port   = 3306
    to_port     = 3306
    protocol    = "tcp"
    cidr_blocks = [data.aws_vpc.target_vpc.cidr_block]
  }
  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }
}

module "db" {
  source  = "terraform-aws-modules/rds/aws"
  version = "~> 2.0"

  identifier = "animals"

  engine            = "mysql"
  engine_version    = "8.0.17"
  instance_class    = "db.t2.micro"
  allocated_storage = 20

  name     = "animalsdb"
  username = "animals"
  password = "ChienChatTigrex3"
  port     = "3306"

  iam_database_authentication_enabled = true

  vpc_security_group_ids = []

  maintenance_window = "Mon:00:00-Mon:03:00"
  backup_window      = "03:00-06:00"

  # Enhanced Monitoring - see example for details on how to create the role
  # by yourself, in case you don't want to create it automatically
  monitoring_interval = "30"
  monitoring_role_name = "RDSMonitoringRole"
  create_monitoring_role = true

  tags = {
    Owner       = "chaos"
    Environment = "demo"
  }

  # DB subnet group
  subnet_ids = data.aws_subnet_ids.all.ids

  # DB parameter group
  family = "mysql8.0"

  # DB option group
  major_engine_version = "8.0"

  # Snapshot name upon DB deletion
  final_snapshot_identifier = "animalsdb"

  # Database Deletion Protection
  deletion_protection = false

  parameters = [
    {
      name = "character_set_client"
      value = "utf8"
    },
    {
      name = "character_set_server"
      value = "utf8"
    }
  ]

  options = []
}
