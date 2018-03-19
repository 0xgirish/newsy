from scrap import HT
from newspaper import Article
import pymysql
from datetime import datetime
import unicodedata


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
        titles = [unicodedata.normalize('NFKD', article.title).encode('ascii','ignore') for article in self.articles]
        return titles

    def get_description(self):
        description = [unicodedata.normalize('NFKD', article.text).encode('ascii','ignore') for article in self.articles]
        return description

    def get_publish_date(self):
        publish_date = [article.publish_date for article in self.articles]
        return publish_date

ht_urls = HT.get_urls()

articles = artAdd(ht_urls)
articles.download()
articles.parse()

titles = articles.get_titles()
descrp = articles.get_description()
time_stamp = articles.get_publish_date()

num_articles = len(titles)
#print(num_articles)

source = "Hindustan Times"

# db = pymysql.connect("localhost", "root", "12qwaszx", "newsy")

# cursor = db.cursor()

for i in range(num_articles):
    query = "INSERT INTO `articles`(`Title`, `description`, `source`, `time_stamp`) values(\"%s\", \"%s\", \"%s\", \"%s\")" %(pymysql.escape_string(titles[i].decode("utf-8")),pymysql.escape_string(descrp[i].decode("utf-8")), source,pymysql.escape_string(str(time_stamp[i])))
    #print("(%s, %s, %s, %s)" %(titles[i], descrp[i], source, time_stamp[i]))
    cursor.execute(query)
    db.commit()

# db.close()