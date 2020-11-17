<h3 align="center">Laravel Web Monitor</h3>
<p align="center">這是一套使用 Laravel 所製作的 Domain 監控小工具，提供簡單的管理系統、監控 GUI 顯示畫面。</p>

---
## 預覽

![前台 預覽圖](https://raw.githubusercontent.com/Kantai235/laravel-web-monitor/master/public/img/readme/frontend.png)
▲ 前台預覽目前監控項目的狀態

![後台 預覽圖](https://raw.githubusercontent.com/Kantai235/laravel-web-monitor/master/public/img/readme/backend.png)
▲ 後台管理監控項目

---
## 簡介

這是一套使用 Laravel 所製作的 Domain 監控小工具，採用了 [Laravel Boilerplate](https://github.com/rappasoft/laravel-boilerplate) 作為主要模板下去開發，監控 GUI 顯示畫面則使用了 [Codepen - Status Dashboard](https://codepen.io/rajantha-fernando/pen/gObzJqo) 作為畫面引用。

---
## 怎麼使用？

1. 下載這份專案。
2. 複製 `.env.example` 這個檔案，並以 `.env` 為新命名。
3. 打開 `.env` 並將資料庫(DB, Database)設定完畢。
4. 執行 `composer install`。
5. 執行 `php artisan key:generate`
6. 執行 `php artisan migrate:refresh --seed`
7. 執行 `npm install`。
8. 執行 `npm run production`。
9. 透過 `apache` 或 `nginx` 來部署你的專案。

如果要快速使用的話，需要再運行 `Command` 來自動抓取 IP Address 以及 Ping 值，因此需要執行以下指令：

```sh
php artisan web-monitor:ip-address-scan
php artisan web-monitor:ip-address-ping
```

【微推薦】如果要長期使用的話，請掛載排程 `worker` 去執行以下指令：

```sh
php artisan schedule:run
# 排程請參閱 https://laravel.com/docs/8.x/scheduling
```

【最推薦】如果要長期且穩定使用的話，需要先打開 `app/Console/Kernel.php` 將 `IpAddressPing` 與 `IpAddressScan` 相關項目註解掉，並且啟用 `IpAddressPingJob`、`IpAddressScanJob` 相關項目，最後請掛載 `worker` 並以任務(Job)的形式去執行：

```sh
php artisan schedule:run
# 排程請參閱 https://laravel.com/docs/8.x/scheduling

php artisan queue:work
# Queues 請參閱 https://laravel.com/docs/8.x/queues
```
