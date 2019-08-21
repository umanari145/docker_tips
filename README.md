# Docker&Vagrant tips

Docker&Vagrantの基本コマンドなど

## Docker


フォルダ構成

- public_html 実ソースが同期される場所
- php5.6 PHP5.6のDockerfile
- php7.2 PHP7.2のDockerfile
- public_html 実ソースが同期される場所
- docker-composer.yml 複数コンテナの自動起動


### imageのpull&list表示


```
#imageの取得
docker pull centos:6

#imageのリスト表示
docker images

#image削除
docker rmi イメージID
```

### commit&push

DockerHubへのコミット

```

docker commit コンテナ名 任意の名前
(例 docker commit centos6 umanari145/centos6)
docker push umanari145/centos6:latest

```

### Dockerfileのbuild

imageを作成する<br>
カレントディレクトにDockerfileがあることが前提


```
docker build -t (イメージ名:タグ名)<例web:latest>  .
```
差分のみになるのでDockerfileを更新しておけば差分のみ取り込む<br>
(正確には差分があった以降になる。100行あって60行目に変更を加えた場合、60行目以降は全て新しいイメージ作成処理が走る)


### コンテナ作成

```

# -p 8080:80 メインホストの80にコンテナなの8080を割り当て
# -v /Users/XXXX/docker_dev:/var/www/html メインホストのdocker_devをコンテナ状の/var/wwww/htmlに配置
# umanari145/centos6 というIMAGEから(centos7:latestなどのイメージ名:タグ名のことも多い) --name centos centosという名前のコンテナを作成

#単純起動(外部からアクセスできずサーバーに入って作業するのみ)
docker run -i -t --name コンテナ名 イメージ名 /bin/bash

docker run -it -p 8080:80 -v /Users/matsumoto/docker_dev/public_html:/var/www/html --name centos umanari145/centos6  /bin/bash

# centos7はsystemctlを使うためにオプションと起動シェル(/sbin/init)が若干異なる
docker run --privileged -it -p 8080:80 -d -v /Users/matsumoto/docker_tips/public_html:/var/www/html --name centos umanari145/centos7 /sbin/init

#稼働中のコンテナのプロセス確認
docker ps -a

#コンテナ再起動(止まっていた場合にはこれで再起動)
docker start コンテナ名(ex: centos)

#コンテナ停止
docker stop コンテナ名(ex: centos)

```

### コンテナ作成中へのコマンド

#### docker exec コンテナへのログイン
```
docker exec -it コンテナ名 /bin/bash
#例
docker exec -it php-apache /bin/bash

個別のコンテナのイメージ
docker rm php72

```

### php+mysql別々コンテナでの連携
```
# mysqlのイメージ起動(-dでバッググランド起動)
# -e MYSQL_ROOT_PASSWORD=passないと落ちる
docker run -it  --name mysql -e MYSQL_ROOT_PASSWORD=pass  -d mysql:5.7

# mysqlを見えるようにする(--link mysql:mysqlがそのオプション)
docker run -it -p 8080:80 --name php56 --link mysql:mysql -d php56:apache
```

https://qiita.com/naga3/items/be1a062075db9339762d

### docker-compose(複数のコンテナの同時起動)

```
# コンテナ起動+実行(通常時はimageがすでに出来上がっている)
# バックグランドで実行したい時(-dつけないとコンソール開いて実行中になる)
docker-compose -f docker-compose.ymlのファイル名(docker-compose.ymlの場合は不要) up -d サービス名

# Dockerfileを再ビルド
docker-compose  -f docker-compose.ymlのファイル名(docker-compose.ymlの場合は不要) build サービス名(指定しなければ全て)

# 停止&削除
docker-compose -f docker-compose.ymlのファイル名(docker-compose.ymlの場合は不要)  down サービス名(指定しなければ全て)

# コンテナ削除
docker-compose  -f docker-compose.ymlのファイル名(docker-compose.ymlの場合は不要) rm サービス名(指定しなければ全て)
```

docker compose 一覧<br>
https://qiita.com/nikadon/items/995c5705ff1171f7484d

## Vagrant

### vagrant ファイル作成


```
vagrant init;

#最初からイメージを記述する場合
vagrant init bento/centos-6.7;

```

### vagrant 起動&停止

```
#起動(imageファイルないときは読み込み)
vagrant up;

#停止
vagrant halt;

```
### boxのリスト表示

```
vagrant box list;

```


### boxのエクスポート

package.boxというGB単位のファイルが作成されます。

```
vagrant package;
```

### boxのインポート

```
vagrant box add 任意のボックス名 boxの名前
```
