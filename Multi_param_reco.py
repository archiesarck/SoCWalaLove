
# coding: utf-8

# In[1]:

import sys
from numpy import *
import mysql.connector

uid = int(sys.argv[1])
tid = str(sys.argv[2])

num_videos=0
num_users=0

cnx = mysql.connector.connect(user='root', password='',host='127.0.0.1', database='soc')

cursor_1 = cnx.cursor()
cursor_2 = cnx.cursor()
query_1 = ("select ID from users")

cursor_1.execute(query_1) 

for(ID) in cursor_1:
    #print(ID,Username)
    num_users = num_users+1
cursor_1.close() 

query_2 = ("select VID from videos")
cursor_2.execute(query_2) 

for(VID,Name) in cursor_2:
    #print(VID,Name)
    num_videos = num_videos+1
cursor_2.close()        
cnx.close()

# In[2]:

#initialize number of videos and users



# In[3]:


#initialize attributes
num_params=6
#[difficulty,relevance,complexity,length,production,engaging]


# In[4]:


#create ratings matrix from database
ratings = random.randint(6, size = (num_videos, num_users), dtype=int)
ratings


# In[5]:


#create params_matrix 
params_matrix = random.random(size=(num_videos,num_params))
params_matrix

for i in range(num_videos):
    for j in range(num_params):
        print(params_matrix[i][j])
params_matrix

# In[7]:


#convert params_matrix to unit vectors
for video in range(num_videos):
    norm=linalg.norm(params_matrix[video])
    params_matrix[video][:] = [x / norm for x in params_matrix[video]]
params_matrix


# In[8]:


#load user params
user_params = random.random(size=(num_users,num_params))
user_params


# In[9]:


#convert user_params to unit vectors

for user in range(num_users):
    norm=linalg.norm(user_params[user])
    user_params[user][:] = [x / norm for x in user_params[user]]
user_params


# In[10]:


#rated matrix tells whether a particular movie is rated or not
rated_matrix=(ratings!=0)
rated_matrix


# In[11]:


#get current user index and current topic
#create an array of video indexes video_index[] of all videos belonging 
#to current topic
#such that ratings[user_index][video_index[i]]=0 implies nhy7
#USER is new to the topic
curr_user_index=0 #uid
curr_topic=None   #tid
video_index=[]
for i in range(num_videos):
    if rated_matrix[i][curr_user_index]==False:
        video_index.append(i)
video_index
    


# In[12]:


#get topic_cost of each video, with respect to curr_topic
#closer two topics are, lower the topic_cost
#create an appropriate function to calculate topic_cost with current_topic
#as argument

# '''topic_cost=random.randint(3,size=(num_videos,),dtype=int)
# topic_cost=topic_cost+ones((size(topic_cost),))
# topic_cost'''


# In[13]:


#get var for each user other than current_user
#var=error*topic_cost summed over each video
#var represents rmse*topic_cost. high var => less effect on prediction
# we can neglect those videos which current_user has not watched
def calc_user_var(curr_user,user_params):
    var_mat = zeros(num_users)
    for user in range(num_users):
        if user == curr_user:
            continue
        else:
            for x in range(num_params):
                var_mat[user] += (user_params[user][x] - user_params[curr_user][x])**2
            
    return var_mat
            


    
# In[14]:


user_var = calc_user_var(curr_user_index,user_params)
user_var


# In[15]:


#higher the var, lower the value of that user's prediction
user_val = [1 - x for x in user_var]
user_val


# In[16]:


video_rated = zeros(size(video_index))
p=0
for video in video_index:
    count=0
    for user in range(num_users):
        if user == curr_user_index:
            continue
        else:
            video_rated[p] += ratings[video][user]*user_val[user]
            if rated_matrix[video][user] == True:
                count+=1
    video_rated[p] /= count
    p+=1

video_rated

