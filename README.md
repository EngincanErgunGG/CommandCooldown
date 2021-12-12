# CommandCooldown
Sunucunuzda komut girebilme saniyesi ekler.
# Süreyi Nasıl Değiştiririm?
Eklentinin 43. satırında şöyle bir kod var;
```php
self::$players[$e->getName()] = time() + 4;
```
Son yerde + 4; var bu demek oluyor ki 4 saniye aralıklar ile komut girebilecek. Siz bunu istediğiniz gibi değiştirebilirsiniz. Örn;
```php
self::$players[$e->getName()] = time() + 6;
```
Artık 6 saniyede bir kez kullanılacak.
