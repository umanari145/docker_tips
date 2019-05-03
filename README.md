# Docker tips

Docker&Vagrantの基本コマンドなど

- Docker


docker run -it -p 8080:80 -v /Users/matsumoto/docker_dev:/var/www/html --name centos umanari145/centos6  /bin/bash



## Vagrant

### vagrant ファイル作成


```
vagrant init;

#最初からイメージを記述するう場合
vagrant init bento/centos-6.7

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
vagrant box list

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
