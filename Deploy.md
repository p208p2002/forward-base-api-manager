# 服務部屬
## 1. 安裝相依套件
**一般的laravel佈署方式**
- `cp .env.example .env`
- 設置`.env`
- `php artisan k:g`
- `$ composer install`

## 2. Corn job(自動排程)
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
