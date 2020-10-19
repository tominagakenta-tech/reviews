from django.urls import path
from myprofile import views

app_name = 'myprofile'

urlpatterns = [
    path('', views.top,name='top'),
    path('resume/', views.resume,name='resume'),
]