# Generated by Django 3.1.1 on 2020-10-08 07:18

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('diaries', '0001_initial'),
    ]

    operations = [
        migrations.CreateModel(
            name='Category',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=255, verbose_name='カテゴリ名')),
            ],
        ),
        migrations.AlterField(
            model_name='diary',
            name='category',
            field=models.ForeignKey(on_delete=django.db.models.deletion.PROTECT, to='diaries.category', verbose_name='カテゴリ'),
        ),
    ]
