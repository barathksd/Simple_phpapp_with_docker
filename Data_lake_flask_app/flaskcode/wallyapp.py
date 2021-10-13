# -*- coding: utf-8 -*-
"""
Created on Thu Feb 25 17:02:17 2021

@author: 81807
"""

from flask import Flask, render_template, request, Response, url_for, jsonify, flash, redirect
import pymysql.cursors
import pymysql
import numpy as np
import cv2
import pandas as pd
import os
import sys
import yaml
import pymongo
import datetime as dtlib
from datetime import datetime
import json


dp = 'test'
c = 5
def mongoconnect(dburl,dbname,delete=False):
    client = pymongo.MongoClient(dburl)
    
    db = client[dbname]
    collnames = db.list_collection_names()
    if delete==False:
        return db
    
    for i in collnames:
        db.drop_collection(i)
    db = client[dbname]
    return db

def write_json(wpath,data):
    with open(wpath, 'w') as outfile:
        json.dump(data, outfile)

def myapp():
    app = Flask(__name__)
    app.config['SECRET_KEY'] = '082d96e286cb2cd8d64fc70462466f7d'
    app.debug = True
    
    uri = 'mongodb://localhost:27017/?readPreference=primary&appname=MongoDB%20Compass&ssl=false'
    videodb = mongoconnect(uri,'videoDB')
    dp = 'test'
    
    @app.route("/",methods=['GET','POST'])
    @app.route("/home",methods=['GET','POST'])
    def home():
        print('in home')
        data = None
        if request.method == 'POST':
            print('in post')
            data = request.form
            if 'name' in data.keys():
                if 'startdate' not in data.keys():
                    data['startdate'] = datetime(2021,2,1,0,0,0)
                elif 'enddate' not in data.keys():
                    data['enddata'] = data
                flash('Success','success')
                
            tposts = list(videodb['log'].find())
            tposts.sort(key=lambda x:x['time'])
        
        try:
            assert isinstance(tposts,list)
        except Exception:
            tposts = list(videodb['log'].find())
            tposts.sort(key=lambda x:x['time'])

        posts = tposts[-c:]
        print('posts len',len(posts))
        return render_template('index.html',posts=posts,title='ウォーリーを探せ！',data=data)
    
    @app.route("/increment",methods=['GET','POST'])
    def increment():
        global c
        if request.method == 'POST':
            c = c+5
            return redirect(url_for('home'))
        return '<html></html>'

    return app

if __name__=='__main__':
    myapp().run(debug=True)
    
    