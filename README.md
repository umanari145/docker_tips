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


### コンテナ作成

```

# -p 8080:80 メインホストの80にコンテナなの8080を割り当て
# -v /Users/XXXX/docker_dev:/var/www/html メインホストのdocker_devをコンテナ状の/var/wwww/htmlに配置
# --name centos centosという名前のコンテナを作成

docker run -it -p 8080:80 -v /Users/matsumoto/docker_dev:/var/www/html --name centos umanari145/centos6  /bin/bash

```

## Vagrant

### vagrant ファイル作成


```
vagrant init;

#最初からイメージを記述するう場合
vagrant init bento/centos-6.7;

```

### vagrant 起動&停止

```
#起動
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
