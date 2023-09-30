## cloneの方法
```
git clone git@github.com:YuugouOhno/youtube-jammer.git
```
## 環境構築
### 1.Docker Desktopのインストール
以下のリンクからインストールできます。

https://www.docker.com/products/docker-desktop/

### 2.composerのインストール
Laravelのディレクトリに移動して以下のコードを実行する。
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

ローカルを汚さないようにComposerとPHPを含むdockerコンテナを作成する。

### 3.envファイルの作成
`.env.example`を元に`.env`を作成する

```
cp .env.sample .env
```

### 4.Sailを起動
docker desktopを立ち上げて、以下のコマンドでSailを起動する。

```
./vendor/bin/sail up -d
```
以下のコマンドでデータベースを作成
```
sail artisan migrate
```
`http://localhost`にアクセスしてlaravelを起動　
