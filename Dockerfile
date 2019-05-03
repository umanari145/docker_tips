#イメージの読み込みは下記コマンドで行います。
FROM ubuntu:18.04
#実際のコマンドを使うときはRUN ～になります。
RUN apt-get update -y
RUN apt-get upgrade -y
RUN apt-get install -y apache2
