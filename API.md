# API
[API呼叫範例](https://documenter.getpostman.com/view/981584/SWTG6bHK?version=latest)
## API呼叫說明
- 客戶端的請求`header`提供`Authorization`和`AppName`供FBAM認證
> 認證包含token檢查與使用者是否具有該API的存取權限
- 通過認證的HTTP請求會由FBAM在此次請求中塞入對應的APP KEY
- API端檢查APP KEY使否符合

### Header Data
- Authorization:str(user token，由/login取得)
- AppName:str(欲使用的服務名稱，server端會使用此tag找出AppKey以供存取)
- 其他資料:一併轉送

### Body Data
- 其他資料:一併轉送

### 呼叫範例
```
http://HOST/api/service/http://APP_HOST/APP_ROUTE
```
- HOST:本服務平台網址
- APP_HOST:UDIC服務主機
> 請求內含的網址參數、Header、Body Data，都會被轉送給APP_HOST

---
# 可用API
- API Prefix: /api
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
