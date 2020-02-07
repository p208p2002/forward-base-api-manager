# 轉發式API管理與帳號認證系統
轉發式API管理與帳號認證系統
- Laravel 5.8
- MySQL 4.8
- PHP 7.2

## Feature
- 帳號權限管理
- API請求次數限制/流量管制
- 易於與現有API結合

## 架構與原理
...

## 
### Corn job
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
