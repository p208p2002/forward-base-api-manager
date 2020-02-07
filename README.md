# 轉發式API管理與帳號認證系統
轉發式API管理與帳號認證系統
- Laravel 5.8
- MySQL 4.8
- PHP 7.2

## Feature
- 帳號權限管理
- 可管理多個API
- API請求次數限制/流量管制
- API端無須實作帳號系統
- 易於與現有API結合

## 文檔
- [佈署說明](#)
- [使用說明](#)

## 架構與原理
![系統架構圖](https://github.com/p208p2002/forward-base-api-manager/blob/master/sysarch.png)

## 注意事項
基於轉發式的架構，並且開發時非以速度為第一考量，每個請求會增加約50-100ms的延遲