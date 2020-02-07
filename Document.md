# 使用文件
## 設置admin帳號
- 註冊帳號後修改資料庫中user資料表欄位
- is_admin -> 1

## API端實作說明
欲實作的API應該先設置一組AppKey(字串，自訂)

<img src="https://github.com/p208p2002/forward-base-api-manager/blob/master/md_imgs/api_reg.png" alt="api_reg" width="550" srcset="">

然後檢查每次進來的請求(透過/service)的Header擁有AppKey，並且確保符合
接下來在APP內的實作應該與平常無異，可以正常拿到所有資訊

## 授予個別帳號權限
- 進入 Admin Board > 使用者權限管理
- 授予權限
<img src="https://github.com/p208p2002/forward-base-api-manager/blob/master/md_imgs/user_auth.png" alt="user_auth" width="550" srcset="">
