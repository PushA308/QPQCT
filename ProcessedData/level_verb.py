import csv
import nltk
import shutil
def extract_verb(sentence):
    helping_verbs = ['am','are','is','was','were','be','being','been','have','has','had','shall','will','do','does','did','may','might','must','can','could','would','should']
    #sentence = "what is meant by data structure. it has been long time. i didn't do that"
    tokens = nltk.word_tokenize(sentence)
    tagged = nltk.pos_tag(tokens)
    #print("tagged tokens:-")
    #print(tagged)
    length = len(tagged) - 1
    #print(length)
    a = list()
    i=0
    flg=0
    for item in tagged:
        if item[1][0] == 'V':
            if((item[0] in helping_verbs)!=1):
                a.append(item[0])
                #print(item[0])
                flg=1
    if flg==0:
        a.append("N.A")
    #print(a)
    with open("question_verb.csv","a",newline='') as csvfile:
            spamwriter = csv.writer(csvfile)
            spamwriter.writerow(a)
    return a;

def final():
    fs = open("level.csv","r")
    reader = csv.reader(fs)
    i=0
    a=list()
    b=0
    d=0
    for row in reader:
        a.append(max(row))
        i=i+1
    fs.close()
    res=list(map(int,a))
    print(res)
    p=sum(res)
    print(i)
    print(p)
    l=int(input("input the level from 1-6: "))
    k=(p/(i*l))*100
    print("Efficiency is {}".format(k))
    fs.close()

def calculate_level(line):
    fs = open("bloom verbs.csv","r")
    reader = csv.reader(fs)
    #included_cols = [1]
    a=list()
    b=list()
    #row = next(reader)
    #print(line)
    flg=0
    for word in line:
        i=1
        for row in reader:
            if word.lower() in row:
                a.append(i)
                flg=1
            i=i+1
        if flg==0:
            a.append(0)
        #print(line,a,max(a))
    with open("level.csv","a",newline='') as csvfile:
            spamwriter = csv.writer(csvfile)
            spamwriter.writerow(a)
    fs.close()
    
def view_table():
    f=open("your_csv1.csv","r")
    #reader=csv.reader(f)
    f1=open("question_verb.csv","r")
    reader1=csv.reader(f1)
    rows1 = list(reader1)
    print("-------------------------------------------/n")
    print(rows1)
    #for row in reader1:
    #    print(row)
    
    included_cols=[0]
    included_cols1=[1]
    included_cols2=[2]
    i=1
    

    
f = open("your_csv1.csv","r")
reader = csv.reader(f)
#out_file = open("solution1.csv", "w")
#writer = csv.writer(out_file)
add=0
included_cols = [1]
row = next(reader)
for row in reader:
    content = list(row[i] for i in included_cols)
    a=extract_verb(content[0])
    print(a)
    calculate_level(a)
final()
view_table()
#print(a)
    
f.close()

