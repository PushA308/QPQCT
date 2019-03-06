import csv
import nltk
import shutil

def calculate_level(line):
    fs = open("dummyverb.csv","r")
    reader = csv.reader(fs, delimiter=',')
    alist=list()
    blist=list()
    for row in reader:
        for row_str in row:
           alist.append(row_str)
    words=line.split()
    for word in words:
       blist += word
    first_set = set(alist)
    second_set = set(blist)
    m=first_set.intersection(second_set)
    print(first_set)

line="What are u control is going to happen sooner absorb"
calculate_level(line)