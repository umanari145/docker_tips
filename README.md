# Docker&Vagrant tips

Docker&Vagrantの基本コマンドなど

## Docker

### imageのpull&list表示


```
#imageの取得
docker pull centos:6

#imageのリスト表示
docker images

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


### コンテナ作成

```

# -p 8080:80 メインホストの80にコンテナなの8080を割り当て
# -v /Users/XXXX/docker_dev:/var/www/html メインホストのdocker_devをコンテナ状の/var/wwww/htmlに配置
# --name centos centosという名前のコンテナを作成

docker run -it -p 8080:80 -v /Users/matsumoto/docker_dev:/var/www/html --name centos umanari145/centos6  /bin/bash

```

### コンテナ作成中へのコマンド

#### docker exec コンテナへのログイン
```
docker exec -it コンテナ名
#例
docker exec -it php-apache /bin/bash

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
# 実行(通常時はimageがすでに出来上がっている)
docker-compose up

# バックグランドで実行したい時(-dつけないとコンソール開いて実行中になる)
docker-compose up -d

# Dockerfileを再ビルド()
docker-compose build

# 停止
docker-compose down

# コンテナ削除
docker-compose rm
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
