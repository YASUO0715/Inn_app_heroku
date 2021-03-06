
# 宿検索投稿App

## About this app
---
* 宿をCRUDできるアプリ
* 現在地より近い順に登録してある宿データが表示され、MAP上にピンが刺される。
* 当日対応可能な宿のみ表示される

## 実装機能
---
* 現在地を取得し近い順に登録宿をソート
  * このアプリの核となる機能です。現在地から近い順にソートで表示されGoogleマップ上にピンがドロップされます。

* CRUD
  * 宿がCRUDできるようになっています

* 検索機能
  * 地域での検索が可能です。(今回は八幡平市のみ)

* ファイルアップロード
   * 複数枚画像アップロードへ対応

* Articleモデルに、User Category Status 各モデルが外部キーとして紐付いています。

* SNS認証機能を3つ追加しました。

## 画面
---
TOP画面

![top](app/images/top.png)

一覧画面
![index01](app/images/index01.png)

新規登録画面

![create01](app/images/create01.png)

詳細画面

![show01](app/images/show01.png)

編集画面

![edit01](app/images/edit01.png)

ログイン画面

![login01](app/images/login01.png)



