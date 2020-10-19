from django.urls import reverse_lazy
from django.views import generic
from .forms import ContactForm
from django.shortcuts import redirect
from django.core.mail import send_mail
from django.template.loader import render_to_string

class Top(generic.FormView):
    form_class = ContactForm
    success_url = reverse_lazy('contact:thanks')
    template_name = 'contact/top.html'

    def form_valid(self, form):
        name = form.cleaned_data.get('name')
        email = form.cleaned_data.get('email')
        text = form.cleaned_data.get('text')
        category = form.cleaned_data.get('category')
        subject = 'お問い合わせがありました。'
        message = render_to_string('contact/mail.txt',form.cleaned_data,self.request)
        from_email = 'toritoritorina@gmail.com'
        recipient_list =['toritoritorina@gmail.com']
        send_mail(subject,message,from_email,recipient_list)
        return redirect('contact:thanks')

class Thanks(generic.TemplateView):
    template_name = 'contact/thanks.html'


