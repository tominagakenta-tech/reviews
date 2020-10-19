from django.contrib import admin
from django.urls import path,include

urlpatterns = [
    path('admin/', admin.site.urls),
    path('',include('myprofile.urls')),
    path('reviews/',include('reviews.urls')),
    path('contact/',include('contact.urls')),
    
    path('diaries/',include('diaries.urls')),
    
]
