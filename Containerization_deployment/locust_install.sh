#!/bin/bash
sudo apt-get update -y
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:deadsnakes/ppa -y
sudo apt-get update -y
sudo apt install python3.7 -y
sudo apt install python3-pip -y
pip3 install locust
sudo apt install python3-locust -y
