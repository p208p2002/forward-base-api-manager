# 轉發式API管理與帳號認證系統
FBAM是一個API管理平台，你可以將你的API註冊在上面

FBAM將提供帳號系統與流量限制等功能給你的API，不需在個別API上自己實現

你可以針對每個使用者帳號設定不同的API存取權限，甚至是流量收費

## 開發環境
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
- [佈署說明](https://github.com/p208p2002/forward-base-api-manager/blob/master/Deploy.md)
- [使用文件](https://github.com/p208p2002/forward-base-api-manager/blob/master/Document.md)
- [可用API](https://github.com/p208p2002/forward-base-api-manager/blob/master/API.md)

## 架構與原理
![系統架構圖](https://github.com/p208p2002/forward-base-api-manager/blob/master/md_imgs/sys_arch.png)

## API連接實作流程
1. 使用admin帳號登入系統
2. 將API註冊至系統上
3. API端檢查每個請求是否有包含`AppKey`
> 如果沒有包含登記的AppKey應拒絕此請求

## 呼叫流程
- 客戶端的請求`header`提供`Authorization`和`AppName`供FBAM認證
> 認證包含token檢查與使用者是否具有該API的存取權限
- 通過認證的HTTP請求會由FBAM在此次請求中塞入對應的`AppKey`
- API端檢查`header`中提供的`AppKey`使否符合，若符合回復訊息

> 實現範例參見[FakeApp.php](https://github.com/p208p2002/forward-base-api-manager/blob/master/app/Http/Controllers/Test/FakeApp.php)

## 注意事項
基於轉發式的架構，並且開發時非以速度為第一考量，每個請求會增加約50-100ms的延遲
