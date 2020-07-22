# Simian Army

## intro

En ce début d'année scolaire nous avons encore un peu la tête en vacances. Du coup nous avons décidé de jouer un peu. Mais en bon DevOps que nous sommes, nous allons jouer avec la production ;-)

Frederic Leger de Build-And-Run vous présentera le concept de "Game Day" et comment tout casser votre production pour vous assurer de sa résilience.
Nous aborderons également comment l'intégrer dans votre chaîne de tests pour qu'elle devienne une pratique courante.

Nous vous attendons nombreux !

       .-"-.            .-"-.            .-"-.           .-"-.
     _/_-.-_\_        _/.-.-.\_        _/.-.-.\_       _/.-.-.\_
    / __} {__ \      /|( o o )|\      ( ( o o ) )     ( ( o o ) )
   / //  "  \\ \    | //  "  \\ |      |/  "  \|       |/  "  \|
  / / \'---'/ \ \  / / \'---'/ \ \      \'/^\'/         \ .-. /
  \ \_/`"""`\_/ /  \ \_/`"""`\_/ /      /`\ /`\         /`"""`\
   \           /    \           /      /  /|\  \       /       \

## launch demo app on AWs beanstalk

```sh
eb create demo --cfg v1.0
```

-> ouvrir l'app et la présenter

## simian army

```sh
aws autoscaling describe-auto-scaling-groups --region eu-west-1 | jq '.AutoScalingGroups[].AutoScalingGroupName'
```

```sh
cd SimianArmy
sed -i.bak -e 's/simianarmy.chaos.ASG.target-asg/simianarmy.chaos.ASG.<Your-ASG-Name>/' ./src/main/resources/chaos.properties
./gradlew jettyRun
```

-> Une instance va être killé à la volée ! mais bridé à 1 par jour.
-> utilise un BDD simpleDB -> on peut reset pour voir ! -> sdbnavigator sous chrome

ou

```sh
aws sdb select --select-expression 'select * from SIMIAN_ARMY'
aws sdb batch-delete-attributes --domain-name SIMIAN_ARMY --items 'Name=CHAOS-xxxxxxxxxxxxxxxx'
```

## skeddly

https://www.skeddly.com/

-> run kill-my-ec2s

## k8s

## demo app

```sh
cd k8s/helm/sf4-animals-demo/
helm upgrade demoapp . --install -f values.yaml
kubectl exec -it demoapp-sf4-animals-demo-74b56465b4-5tkxs -- bin/console doctrine:fixtures:load
minikube service --url demoapp-sf4-animals-demo
```

## chaoskube

https://github.com/linki/chaoskube

```sh
helm upgrade chaoskube stable/chaoskube \
  --install --set dryRun=false --set interval=1m --set namespaces=chaos --set rbac.create=true
```

## kube monkey

https://github.com/asobti/kube-monkey

## chaos-mesh

```sh
kubectl apply -f https://raw.githubusercontent.com/chaos-mesh/chaos-mesh/master/manifests/crd.yaml
kubectl create namespace chaos-testing
helm upgrade chaos-mesh helm/chaos-mesh --namespace=chaos-testing --install --set dashboard.create=true --set chaosDaemon.runtime=containerd --set chaosDaemon.socketPath=/run/k3s/containerd/containerd.sock
kubectl port-forward -n chaos-testing svc/chaos-dashboard 2333
```

https://play.kahoot.it/#/?quizId=a415f861-d648-42cd-936a-f91b977116d1
