from scrap import HT, NDTV ,TOI
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

    def get_image_url(self):
        image_url = [article.top_image for article in self.articles]
        return image_url

def run():

    ht_urls = HT.get_urls()
    ndtv_urls = NDTV.get_urls()
    toi_urls = TOI.get_urls()

    urls = []
    urls.extend(ht_urls)
    urls.extend(ndtv_urls)
    urls.extend(toi_urls)

    articles = artAdd(urls)
    articles.download()
    articles.parse()

    titles = articles.get_titles()
    descrp = articles.get_description()
    time_stamp = articles.get_publish_date()
    image_url = articles.get_image_url()

    num_articles = len(titles)
    #print(num_articles)

    source = "Hindustan Times"

    db = pymysql.connect("localhost", "root", "12qwaszx", "newsy")

    cursor = db.cursor()

    for i in range(num_articles):
        try:
            if time_stamp[i] == None:
                query = "INSERT INTO `articles`(`Title`, `description`, `source`, `link`, `image_url`) values(\"%s\", \"%s\", \"%s\", \"%s\", \"%s\")" %(pymysql.escape_string(titles[i].decode("utf-8")), pymysql.escape_string(descrp[i].decode("utf-8")),source ,urls[i], image_url[i])
            else:
                query = "INSERT INTO `articles`(`Title`, `description`, `source`, `time_stamp`, `link`, `image_url`) values(\"%s\", \"%s\", \"%s\", \"%s\", \"%s\", \"%s\")" %(pymysql.escape_string(titles[i].decode("utf-8")),pymysql.escape_string(descrp[i].decode("utf-8")), source,time_stamp[i].strftime('%Y-%m-%d %H:%M:%S'), urls[i], image_url[i])
            cursor.execute(query)
            db.commit()
        except pymysql.MySQLError:
            #code, *msg = e.args
            #print("ERROR CODE: {} | {}".format(code, *msg))
            pass

    db.close()