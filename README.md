# 轉發式API管理與帳號認證系統
轉發式API管理與帳號認證系統
- Laravel 5.8
- MySQL 4.8
- PHP 7.2
## Feature
...

## Corn job
讓系統自動刷新每日的帳號免費請求次數

**此功能必須運行在Linux底下**
> [corn job refs](https://jqnets.com/blog/ubuntu-%E6%8E%92%E7%A8%8B%E8%A8%AD%E5%AE%9A-%EF%BC%9Acrontab-%E6%8E%92%E7%A8%8B%E4%BD%BF%E7%94%A8%E6%95%99%E5%AD%B8/)

> 若是其他OS需自行撰寫排程呼叫指令`php artisan schedule:run`
### Setting Corn job
- 編輯 corn job `$ vim etc/crontab`
```
# 每天 00:00 執行laravel排程
00 00   * * *  cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

- 開啟corn `$ service cron start`

## API Document
[API Document](https://documenter.getpostman.com/view/981584/SWTG6bHK?version=latest)

## Prefix
- /api
## Action
## Post:/login
登入取得token
### Body Data
- account:str(email)
- password:str
### 返回
```
{"Token":"iyJSbyAj1b0Q5em3H8KmzgVK11anBa43jxuKHzHFRGa7b3AKep54BgSJXI49"}
```

## Any:/service/{uri}
- 轉送服務給UDIC服務，中介允許執行認證功能
- Http Method、Header Data、Body Data都會被轉送
> GET、POST、PUT、DELETE、PATCH
- Authorization、AppName檢查
- 設置正確的AppName，通過檢查後會將原請求塞入AppKey(保存於平台資料庫內)，APP端檢查僅需檢查KEY是否符合
### API呼叫說明
#### Header Data
- Authorization:str(user token，由/login取得)
- AppName:str(欲使用的服務名稱，server端會使用此tag找出AppKey以供存取)
- 其他資料:一併轉送

#### Body Data
- 其他資料:一併轉送

#### 呼叫範例
```
http://HOST/api/service/http://APP_HOST/APP_ROUTE
```
- HOST:本服務平台網址
- APP_HOST:UDIC服務主機
> 請求內含的網址參數、Header、Body Data，都會被轉送給APP_HOST

### APP實作說明
欲實作的APP應該先設置一組AppKey(字串，自訂)

然後檢查每次進來的請求(透過/service)的Header擁有AppKey，並且確保符合

接下來在APP內的實作應該與平常無異，可以正常拿到所有資訊