#include <unistd.h> 
#include <iostream> 

using namespace std;

void funct1();
void funct2();

int main(){
	cout<<"\nThe main program:"<<getpid()<<endl;
	funct1();
	funct2();
	cout<<"\n The main program"<<getpid()<<endl; 
}

void funct1(){
	cout<<"--------------------";
	cout<<"\n The funct1 process id: "<<getpid()<<endl;
}

void funct2(){
	cout<<"--------------------";
	cout<<"\n The funct2 process id: "<<getpid()<<endl;
}
