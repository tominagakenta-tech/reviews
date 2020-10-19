from django.db import models
from django.utils import timezone

class Review(models.Model):
    STARS = (
        (1,'☆'),
        (2,'☆☆'),
        (3,'☆☆☆'),
        (4,'☆☆☆☆'),
        (5,'☆☆☆☆☆')
    )

    #idはdjangoが自動的に記載
    store_name = models.CharField('店名', max_length=255)
    title = models.CharField('タイトル', max_length=255)
    text = models.TextField('口コミテキスト', blank=True)
    stars = models.IntegerField('星の数', choices=STARS) #ForeignKeyとは??→一つのidに対していくつかの情報が対応するp97フィールドとは型、class　IntegerField
    created_at = models.DateTimeField('作成日', default=timezone.now)

    def __str__(self):
        return self.title
