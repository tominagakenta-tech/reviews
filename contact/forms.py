from django import forms

class ContactForm(forms.Form):
    CATEGORIES = (
        ('仕事','お仕事の依頼'),
        ('サイト内容問い合わせ','サイト内容に関するお問い合わせ'),
    )

    name = forms.CharField(
        label='お名前',max_length=50,
        required=False, help_text='＊任意'
    )
    email =forms.EmailField(
        label='メールアドレス',required=False, help_text='＊任意'
    )
    text = forms.CharField(label='お問い合わせ内容',widget=forms.Textarea)
    category = forms.ChoiceField(label='カテゴリ',choices=CATEGORIES)