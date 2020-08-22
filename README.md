# Neler Yapar?

Netgsm'in izin verdiği tüm *API'leri* kullanarak, ihtiyacınıza yönelik işlemleri sisteminizde uygulayabilirsiniz ve bunu otomasyona çevirebilirsiniz.

Başlıca kullanım alanı, SMS ve Sesli Mesaj *API'lerinden* ibarettir. İlerleyen vakitler de tüm **NETGSM** apilerini aktif edeceğim.

# Kullanımı
Oldukça şeffaf bir şekilde uygulamayı geliştirmeye çalıştım, bu yüzden eksik gördüğünüz alanları lütfen **issue** alanından bana bildirin.

## Başlangıç
Kütüphaneyi composer yardımı ile projenize dahil edin

	composer require senemco/netgsm-api

Proje dosyanızda eğer composer'ı çağırmadıysanız aşağıdaki ilk satırı uygulamayı unutmayın. Aksi halde diğer satırlara devam edebilirsiniz.

	require('../vendor/autoload.php');
	
	use SenemCO\Netgsm;
	$netgsm = new Netgsm();
	
Sistemi Netgsm'e tanıtmak için bir konfigürasyon gerekmektedir. Bu bilgiler netgsm ile kütüphane arasındaki veri alışverişini sağlar. Aksi halde, verileri alamaz yada gönderemezsiniz.

	$netgsm->setConfig([
		"username"=>"netgsm-kullaniciadi",
		"password"=>"netgsm-şifre",
		"companyname"=>"netgsm-şirketadi"
	]);

*companyname* -> netgsm'in sizin için izin verdiği şirket başlığıdır. İzin verilenin dışında bir şey yazılması, gönderim esnasında hata vermesine sebep olacaktır.

Tüm bunların ardından kütüphaneyi kullanmaya başlayabilirsiniz.

### SMS İşlemleri

En çok rağbet görecek olan sınıf sms yapısıdır. Bir çok firma kullanıcılarına/müşterilerine reklam yada hesap bilgileri için bu tür uygulamaları çok kullanır.

#### SMS Nasıl Gönderilir

	$sender = $netgsm->sms->messages('Gönderilecek metin')
	->numbers( ['905000000000' , '905000000000'] )
	->send();

	var_dump($sender);

- Messages: *String* -  Gönderilecek metin
- Numbers: *Array* - Kimlere gönderilmesini istiyorsanız, kişilerin numaralarını belirtmeniz gerekir.
- Send: Gönderme işlemini tamamlar ve size bir değer döndürür. Hata yada Başarılı gönderim mesajlarını incelemek için [şu sayfayı](https://www.netgsm.com.tr/dokuman/#xml-post-sms-g%C3%B6nderme) ziyaret edebilirsiniz.

#### Size Gelen Mesajları Görmek
Numaranıza atılmış mesajları buradan listeleyebilirsiniz.

	$query = $netgsm->sms->receive();
	var_dump($query);
	
#### Kara Listeye Ekleme/Çıkarma
Kısacası, eğer bir numara kara listedeyse, siz istediğiniz kadar gönderim alanına bu numarayı ekleyin. Kişi numarası kara listede olduğu için bahsi geçen numaraya mesaj gönderilmeyecektir. 

Bu işlem genelde Bddk izni nedeniyle oluşturulmuştur. Taciz maksatlı mesajlar istemeyen kullanıcılar için bu fonksiyonu kullanabilir ve kişinin numarasını kara listeye alabilirsiniz

	$query = $netgsm->sms
	->registerBlackList(true , [
		'905000000000' , '905000000000' , '905000000000'
	])
	echo $query // Dönen Değer OK! 

Eğer kullanıcı karalisteye almak istiyorsanız, ilk parametre *true* olmalıdır. Eğer kişinin numarasını kara listeden çıkarmak istiyorsanız ilk parametre değeri *false* dönmesi gerekiyor.

### Sesli Mesaj
Müşterilerinize sesli dinamik mesajlar göndererek, onlara bilgiler sunabilirsiniz. Bu çok basit bir işlem ile gerçekleşmektedir. 

	$query  =  $netgsm->voice
	->messages([
		'<text>İlk Sesli Mesajınız</text>',
		'<audioid>123456</audioid>',
		'<text>İkinci Mesajınız</text>'
	])
	->numbers(['905000000000' , '905000000000' , '905000000000'])
	->send();
  
- `<text></text>` Bu etiket arasına yazılan metinler bir bot tarafından okunur.
- `<audioid></audioid>` Bu etiket, netgsm paneli tarafından eklediğiniz ses dosyalarının idsini eklemenize ve arama esnasında bahsi geçen ses kaydının okunmasını sağlar.

## Geliştirme
Sizde bu kütüphaneye destek olabilirsiniz. Kütüphaneyi beğendiğiniz takdir de lütfen STAR vererek beni mutlu etmeyi ihmal etmeyin. 
**İyi Çalışmalar**
