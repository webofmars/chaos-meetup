# usage

## setup

```sh
virtualenv .venv
source .venv/bin/activate
pip install -r requirements.txt
brew tap shopify/shopify
brew install toxiproxy
```

## delete aws instance | chaosmonkey

```sh
.venv/bin/chaos run experiment1-aws.json
```

## add some network latency

```sh
toxiproxy-server -config toxiproxy-config.json
.venv/bin/chaos run experiment2-toxiproxy.json
```

## generate a report

```sh
.venv/bin/chaos report --export-format=html5 journal.json raport.html
```
