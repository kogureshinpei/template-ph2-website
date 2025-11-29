FROM mysql:8
#mysql:8はDebianベースなので、Oracle Linux ベースに変更することで日本語対応を行う
#また、PHPフレームワーク(Laravelなど)を使う場合、一定のバージョンがないと動作しないことがあるため、MySQLのバージョンを8に固定しています。
# FROM oraclelinux:8-slim

# Oracle Linux のためのパッケージマネージャーのインストール
USER root
RUN microdnf install -y glibc-locale-source glibc-langpack-en

# 日本語ロケールの生成と設定
RUN localedef -i ja_JP -f UTF-8 ja_JP.UTF-8

# 環境変数の設定
ENV LANG ja_JP.UTF-8
ENV LC_ALL ja_JP.UTF-8
# タイムゾーン(東京)
ENV TZ Asia/Tokyo
# MySQLのconfigファイル(my.cnf)をコピー
COPY ./docker/mysql/my.cnf /etc/my.cnf

# キャッシュと不要なファイルの削除
RUN microdnf clean all
