import csv
import nltk
import shutil
import os
import sys
import traceback
import win32com.client #pip install pywin32

import nltk #pip install nltk
#nltk.download('punkt')
#nltk.download('averaged_perceptron_tagger')
#include other ntlk packages, if asked for.

##########################################
#initialized variables
##########################################
question_no_column = 7
start_index = 16


def process_question_paper(ques_paper_path) :
    fd = open(os.path.join(os.getcwd(),"processed_data.csv"),'w')
    headers = "Marks, CO_Type, Module No, Question Type, Question No, SUb Que No., Question"
    fd.write(headers + '\n')
    for root, dirs,files in os.walk(ques_paper_path) :
        for file in files:
            if file.endswith('.xls') :
                file_path = os.path.join(root,file)
                try:
                    excel = win32com.client.Dispatch('Excel.Application')
                    workbook = excel.Workbooks.open(file_path)
                    sheet = workbook.WorkSheets('QuestionPaper')
                    for start_row in range(start_index, 50):
                        try:
                            row, col = start_row, question_no_column
                            question = sheet.Cells(row, col).value

                            if question is not None:
                                row, col = start_row, question_no_column + 1
                                marks = str(sheet.Cells(row, col).value)
                                row, col = start_row, question_no_column + 2
                                co_type = str(sheet.Cells(row, col).value)
                                row, col = start_row, question_no_column + 4
                                module_no = str(sheet.Cells(row, col).value)
                                row, col = start_row, question_no_column - 5
                                question_type =  sheet.Cells(row, col).value
                                row, col = start_row, question_no_column - 2
                                question_no =  sheet.Cells(row, col).value
                                row, col = start_row, question_no_column - 1
                                sub_question_no = sheet.Cells(row, col).value
                                row, col = start_row, question_no_column - 2
                                question_no =  sheet.Cells(row, col).value
                                row, col = start_row, question_no_column
                                question =  sheet.Cells(row, col).value
                                print (question+'\n')
                                fd.write(marks + ','+co_type + ',' + module_no + ',' +question_type + ','+ question_no + ',' + sub_question_no + ',' +question + '\n')
                            else:
                                pass


                        except Exception as e:
                            print ("hhj")
                            pass
                    workbook.Close(True)
                except Exception as e:
                    print ("ERROR")
                    pass
    fd.close()


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
    with open("File/question_verb.csv","a",newline='') as csvfile:
            spamwriter = csv.writer(csvfile)
            spamwriter.writerow(a)
    return a;

#analysis of question paper using verbs
def final(k):
    fs = open("File/level.csv","r")
    reader = csv.reader(fs)
    i=0
    a=list()
    b=0
    d=0
    for row in reader:
        with open("File/Value_level.csv","a",newline='') as csvfile:
            spamwriter = csv.writer(csvfile)
            spamwriter.writerow(max(row))
        a.append(max(row))
        i=i+1
    fs.close()
    if k==1:
        res=list(map(int,a))
        print(res)
        p=sum(res)
        print(i)
        print(p)
        l=int(input("input the level from 1-6: "))
        k=(p/(i*l))*100
        print("Average quality per question is {}".format(k))
        fs.close()

#calculating verb's level using bloom's taxonomy
def calculate_level(line):
    fs = open("File/bloom verbs.csv","r")
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
    with open("File/level.csv","a",newline='') as csvfile:
            spamwriter = csv.writer(csvfile)
            spamwriter.writerow(a)
    fs.close()
    
def view_table():
    f=open("File/your_csv1.csv","r")
    #reader=csv.reader(f)
    f1=open("File/question_verb.csv","r")
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
    
def compare_Type():
    f1=open("File/bloom_type.csv","r")
    f2=open("File/Value_level.csv","r")
    r1 = list(f1)
    length = len(r1)
    r2 = list(f2)
    sum=0
    for i in range(length):
        if r1[i]==r2[i]:
            k=abs(int(r1[i])-int(r2[i]))
            sum=sum+k
            print(chr(ord('A') + k))
        else:
            k=abs(int(r1[i])-int(r2[i]))
            sum=sum+k
            print(chr(ord('A') + k))
    print("Avg quality per question: "+chr(ord('A')+int(sum/length)))
    
 #Start:   
if __name__ == "__main__" :
    arg_cnt = len(sys.argv)
    if arg_cnt > 1:
        ques_paper_path = sys.argv[1]
        process_question_paper(ques_paper_path)
    else:
        print ("Please provide question paper directory path !")    

f = open("processed_data.csv","r")
reader = csv.reader(f)
#out_file = open("File\solution1.csv", "w")
#writer = csv.writer(out_file)
add=0
included_cols = [2]
included_cols1=[0]
row = next(reader)
for row in reader:
    content = list(row[i] for i in included_cols) #selecting question
    content1 = list(row[i] for i in included_cols1) #selecting question type
    
        
    with open("File/bloom_type.csv","a",newline='') as csvfile:
        spamwriter = csv.writer(csvfile)
        if content1[0]=="remembering":
            spamwriter.writerow("1")
        elif content1[0]=="understanding":
            spamwriter.writerow("2")
        elif content1[0]=="applying":
            spamwriter.writerow("3")
        elif content1[0]=="analyzing":
            spamwriter.writerow("4")
        elif content1[0]=="evaluating":
            spamwriter.writerow("5")
        elif content1[0]=="creating":
            spamwriter.writerow("6")
    a=extract_verb(content[0])
    print(a)
    calculate_level(a)
k=int(input("Select the option for Analysis of Question Paper:\n1.Verbs\n2.Question Type\n3.Course Outcome"))
if k==1:
    final(k)
elif k==2:
    final(k)
    compare_Type()
v=int(input("View Information:\n1.Question Paper\n2.Verbs\n3.Bloom's Level\n"))
if v==1:
    f = open("File/UOS_paper.csv","r")
    reader = csv.reader(f)
    for row in reader:
        print(row)
    f.close()
elif v==2:
    f = open("File/question_verb.csv","r")
    reader = csv.reader(f)
    for row in reader:
        print(row)
    f.close()
elif v==3:
    f = open("File/Value_level.csv","r")
    reader = csv.reader(f)
    for row in reader:
        print(row)
    f.close()
    
    

#print(a)
    
f.close()

