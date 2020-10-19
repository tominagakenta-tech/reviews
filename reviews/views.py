from django.shortcuts import render,get_object_or_404, redirect,resolve_url
from .models import Review
from .forms import ReviewCreateForm

from django.urls import reverse_lazy

def review_list(request):
    context = {
        'review_list':Review.objects.all(),
    }
    return render(request, 'reviews/review_list.html', context) #render関数で口コミデータをテンプレートファイルに渡している。

def review_detail(request, pk):
    context = {
        'review': get_object_or_404(Review,id=pk)
    }
    return render(request, 'reviews/review_detail.html',context)

def review_create(request):
    form =ReviewCreateForm(request.POST or None)
    if request.method == 'POST' and form.is_valid():
        form.save()
        return redirect('reviews:review_list')

    context = {
        'form':form
    }
    return render(request, 'reviews/review_form.html', context)

def review_create_send(request):
    form = ReviewCreateForm(request.POST)
    if form.is_valid():
        form.save()
        return  redirect('reviews:review_list')

    else:
        context = {
            'form': form,
        }
        return render(request, 'reviews/review_form.html', context)

def review_update(request, pk):
    review = get_object_or_404(Review, pk=pk)
    form = ReviewCreateForm(request.POST or None, instance=review)
    if request.method == 'POST' and form.is_valid():
        form.save()
        return redirect('reviews:review_list')

    context={
        'fomr':form
    }
    return render(request,'reviews/review_form.html', context)

def review_delete(request, pk):
    review = get_object_or_404(Review, pk=pk)
    if request.method == 'POST':
        review.delete()
        return redirect('reviews:review_list')

    context = {
        'review':review
    }
    return render(request, 'reviews/review_confirm_delete.html', context)

