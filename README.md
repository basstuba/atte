# atte

勤怠管理アプリケーションです。出退勤の登録及び休憩時間を複数回取得してもすべて登録、管理可能です。

![ホーム画面](home.png)

## 作成した目的

クライアントから要望のあった機能をすべて持った勤怠管理システムを構築するため作成しました。

## アプリケーションURL

http://localhost

始めにログイン画面が表示されますのでアカウントを作成しログインしてください。

## 機能一覧

・アカウント作成機能

・アカウント作成時のメール認証機能

・ログイン及びログアウト機能

・勤務開始及び終了時間登録機能

・休憩開始及び終了時間登録機能

・日付別勤怠確認機能

・個人別勤怠確認機能

**日付別勤怠確認機能及び個人別勤怠確認機能はページネーションを使用して5件づつの表示となっています。**

## 使用技術

・Laravel 8

・nginx 1.21.1

・php 7.4.9

・html

・css

・mysql 8.0.26

## テーブル設計

![テーブル設計書](atte.table.png)

## ER図

![ER図](atte.drawio.png)

# 環境構築

### 1 Gitファイルをクローンする

git clone git@github.com:basstuba/atte.git

### 2 Dockerコンテナを作成する

docker-compose up -d --build

### 3 Laravelパッケージをインストールする

docker-compose exec php bash

でPHPコンテナにログインし

composer install

### 4 .envファイルを作成する

PHPコンテナにログインした状態で

cp .env.example .env

作成した.envファイルの該当欄を下記のように変更

DB_HOST=mysql

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp

MAIL_HOST=mail

MAIL_PORT=1025

MAIL_FROM_ADDRESS=tubatest@gmail.com（メールアドレスはご自由に設定してください。）

MAIL_FROM_NAME="${APP_NAME}"

### 5 テーブルの作成

docker-compose exec php bash

でPHPコンテナにログインし(ログインしたままであれば上記コマンドは実行しなくて良いです。)

php artisan migrate

### 6 アプリケーション起動キーの作成

PHPコンテナにログインした状態で

php artisan key:generate

## 補足

### 1 新規登録時の認証メールは**MailHog**へ送信されるように設定しています。

URL-> http://localhost:8025

### 2 docker-compose.ymlの設定はlocalhostでの接続設定になっています。

### 3 AWSの環境の確認はIAMユーザーを選択して”アカウントID->471112662470“,”ユーザーネーム->guest-user”,”パスワード->G-user/2024”でログインしてください。

リージョンは東京を選択すれば確認できます。

### 4 AWSで環境構築したアプリケーションの起動方法は下記の通りです。

EC2のインスタンスを起動

コマンドラインで

cd ~/atte

docker-compose up -d

### 5 URLは下記の通りです。

atte-> http://54.250.239.164

MailHog-> http://54.250.239.164:8025

採点が終了するまでEC2インスタンスを起動したままにしておきますので確認できると思います。
（インスタンスを起動したままにする理由は停止して再起動するとIPアドレスが変わってしまいURLも変わってしまうためです。その為READMEにはURLを記入していませんでしたが、修正させていただきました。）