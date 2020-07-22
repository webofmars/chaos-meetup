# deploy on AWS

**WARNING**
This is intended for launching a demo app for a short time only.
There is some manual steps to ensure everithing is cleaned and can cost you money
(actually a lot) if you leave some parts running. So you've been warned use it a your own risk ;-)
**WARNING**

```sh
cd IaC/rds
terraform apply -var vpc_id=vpc-xxxxxxxxxxxxxxxx
cd -
# edit config files for rds params
eb config put v1.x
eb create staging --cfg v1
# play a bit with it
eb config put v2.x
eb config --cfg v2
```

# test it with curl

```sh
export URL=http://xxxxxxx.eu-west-1.elasticbeanstalk.com/
while true; do curl -qs -o - ${URL} | grep 'running on'; sleep 1; done
```
