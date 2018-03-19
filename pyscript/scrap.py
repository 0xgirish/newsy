import requests
from bs4 import BeautifulSoup
import unicodedata
from newspaper import Article, build
from urllib.request import urlopen


class NDTV:
	feed_url = "http://feeds.feedburner.com/ndtvnews-latest"
	def get_urls(feed_url):
		url = urlopen(feed_url)
		soup = BeautifulSoup(url, 'xml')
		pages = []
		for item in soup('item'):
			page_link = item('link')[0]
			pages.append(page_link.text)
		
		return pages

class TOI:
	def get_urls(feed_url):
		url = urlopen(feed_url)
		soup = BeautifulSoup(url, 'lxml')
		pages = []
		for ultag in soup.find_all('ul', {'data-vr-zone': 'latest'}):
			for li in ultag('li'):
				for a in li.find_all('a', href=True):
					link = a['href']
					if link[0] == '/':
						link = "https://timesofindia.indiatimes.com/" + link
					pages.append(link)
		
		return pages

class HT:
	def get_urls(feed_url):
		url = urlopen(feed_url)
		soup = BeautifulSoup(url, 'lxml')
		pages = []
		for ultag in soup.find_all('ul', {'class': 'latest-news-bx more-latest-news more-separate'}):
			for li in ultag('li'):
				for a in li.find_all('a', href=True):
					link = a['href']	
				pages.append(link)
		return pages


p = HT.get_urls("https://www.hindustantimes.com/latest-news/")

print(p[0])
article = Article(p[0])
article.download()
article.parse()
print(article.title)
print(article.text)

# ht = build("https://www.hindustantimes.com/latest-news/")
# for article in ht.articles:
# 	print(article.url)
