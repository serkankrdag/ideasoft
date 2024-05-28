
## Kurulum

Proje kurulumu için repo klonlandıktan sonra kök dizininde terminalden ```docker-compose up -d``` yazmak yeterlidir proje docker test ortamında otomatik olarak ayağa kaldırılıp veritabanı tabloları ve product, customer gibi hazır datalar migration ve seederlar sayesinde otomatik olarak kurulur.

## Anlatım

Proje istenilen şekilde görev 1 ve görev 2 için tüm şartları sağlayacak şekilde hazırlandı, sipariş için ekleme silme ve listeleme işlemleri yapılabiliyor ve sipariş eklenirken stok yetersiz ise uyarı veriyor aynı zamanda sipariş verilirken indirimler otomatik olarak uygulanıyor.

- Sipariş eklemek için örnek post datası:

```json
{
    "customerId": 2,
    "items": [
        {
            "productId": 100,
            "quantity": 2
        },
        {
            "productId": 104,
            "quantity": 1
        }
    ]
}
```

- Sipariş silmek için örnek post datası:

```json
{
    "orderId": 1
}
```

## Kullanılanlar

- Migrationlar ile veritabanı tabloları hazırlandı.
- Seederslar ile gerekli veriler ilk proje kurulumunda veritabanına yükleniyor.
- Services ile indirimler artıp azalabilecek şekilde ayarlandı.
- Dockerfile ve docker-compose.yml dosyaları proje ilk ayağa kaldırılırken gerekli işlemleri yapıcak şekilde ayarlandı.

