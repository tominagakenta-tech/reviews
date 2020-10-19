from django.shortcuts import render
from diaries.models import Diary

def top(request):
    context = {
        'diary_list':Diary.objects.all(),
        'profile': {'name':'Taro','age':'30','city':'tokyo'}
    }
    return render(request,'diaries/diary_list.html',context)

    