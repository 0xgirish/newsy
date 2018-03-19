from scrap import HT
from newspaper import Article
import pymysql
from datetime import datetime

class artAdd:

    def __init__(self, urls):
        self.articles = [Article(url) for url in urls]

    def download(self):
        for article in self.articles:
            article.download()

    def parse(self):
        for article in self.articles:
            article.parse()

    def get_titles(self):
        titles = [article.title for article in self.articles]
        return titles

    def get_description(self):
        description = [article.text for article in self.articles]
        return description

    def get_publish_date(self):
        publish_date = [article.publish_date for article in self.articles]
        return publish_date

ht_urls = HT.get_urls("https://www.hindustantimes.com/latest-news/")

articles = artAdd(ht_urls)
articles.download()
articles.parse()

titles = articles.get_titles()
descrp = articles.get_description()
time_stamp = articles.get_publish_date()

num_articles = len(titles)

source = "Hindustan Times"

db = pymysql.connect("localhost", "root", "12qwaszx", "newsy")

cursor = db.cursor()

for i in range(num_articles):
    query = "INSERT INTO articles(Title, description, source, time_stamp) values({}, {}, {}, {})".format(titles[i], descrp[i], source, str(time_stamp[i]))
    cursor.execute(query)

db.close()