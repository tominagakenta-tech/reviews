from django.urls import path
from diaries import views

app_name = 'diaries'

urlpatterns = [
    path('',views.top, name='top')
]