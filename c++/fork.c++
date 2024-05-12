#include <iostream>
#include <unistd.h> 

using namespace std; 

int main(){

	cout<<endl<<"Process ID: "<< getpid()<<endl; 
	fork();
	cout<<"chiled 1 proccessID"<<getpid()<<endl;
	return 1; 
}
