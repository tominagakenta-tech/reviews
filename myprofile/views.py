from django.shortcuts import render
from django.http import HttpResponse
from django.template import loader


def top(request):
    context = {
    'name':'たろう',
    }
    return render(request, 'myprofile/top.html',context)

def resume(request):
    return render(request, 'myprofile/resume.html')

