import requests
from bs4 import BeautifulSoup
import unicodedata
from newspaper import Article, build
from urllib.request import urlopen


class NDTV:
	def get_urls():

		feed_url = "http://feeds.feedburner.com/ndtvnews-latest"
		url = urlopen(feed_url)
		soup = BeautifulSoup(url, 'xml')
		pages = []
		for item in soup('item'):
			page_link = item('link')[0]
			pages.append(page_link.text)
		
		return pages

class TOI:
	def get_urls():
		feed_url = "https://timesofindia.indiatimes.com/"
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
	def get_urls():
		feed_url = "https://www.hindustantimes.com/latest-news/"
		url = urlopen(feed_url)
		soup = BeautifulSoup(url, 'lxml')
		pages = []
		for ultag in soup.find_all('ul', {'class': 'latest-news-bx more-latest-news more-separate'}):
			for li in ultag('li'):
				for a in li.find_all('a', href=True):
					link = a['href']	
				pages.append(link)
		return pages

 


ndtv_news = NDTV.get_urls()
times_of_india_news = TOI.get_urls()
hindustantimes_news = HT.get_urls()

# info = []

# for news in times_of_india_news:
# 	article = Article(news)
# 	article.download()
# 	article.parse()
# 	title = article.title
# 	desc = article.text
# 	link = news
# 	time = article.html
# 	source = "NDTV"
# 	print(time)



# p = HT.get_urls("https://www.hindustantimes.com/latest-news/")

# print(p[0])
# article = Article(p[0])
# article.download()
# article.parse()
# print(article.title)
# print(article.text)

