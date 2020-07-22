# Chaos Monkey

```sh
aws autoscaling create-launch-configuration --launch-configuration-name lc1 --instance-type t2.micro --image-id ami-03e7fbee71da4a5fa --key-name 'frederic@webofmars.com' --region eu-west-1
```

```sh
aws autoscaling create-auto-scaling-group --auto-scaling-group-name monkey-target --launch-configuration-name lc1 --availability-zones eu-west-1a eu-west-1b --min-size 2 --max-size 2 --region eu-west-1
```

```
aws configure set preview.sdb true
aws sdb create-domain --domain-name SIMIAN_ARMY --region eu-west-1
```

```
git clone git://github.com/Netflix/SimianArmy.git
vi src/main/resources/client.properties
vi src/main/resources/simianarmy.properties
vi src/main/resources/chaos.properties
```

_Notes:_

- don't work on all regions (sdb endpoints)
- verify the emails domains or adresse used in the config
