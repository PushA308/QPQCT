import csv
import nltk

def extract_verb(sentence):
    helping_verbs = ['am','are','is','was','were','be','being','been','have','has','had','shall','will','do','does','did','may','might','must','can','could','would','should']
    #sentence = "what is meant by data structure. it has been long time. i didn't do that"
    tokens = nltk.word_tokenize(sentence)
    tagged = nltk.pos_tag(tokens)
    #print("tagged tokens:-")
    #print(tagged)
    length = len(tagged) - 1
    a = list()
    for item in tagged:
        if item[1][0] == 'V':
            if((item[0] in helping_verbs)!=1):
                a.append(item[0])
    print(a)
    return a;
    
f = open("your_csv1.csv","r")
reader = csv.reader(f)
out_file = open("verbs_extracted.csv", "w")
#writer = csv.writer(out_file)
included_cols = [1]
row = next(reader)
for row in reader:
    content = list(row[i] for i in included_cols)
    a=extract_verb(content[0])
    with open("verbs_extracted.csv","a",newline='') as csvfile:
        spamwriter = csv.writer(csvfile)
        spamwriter.writerow(list(row[0])+a+list(row[2]))
    
f.close()

