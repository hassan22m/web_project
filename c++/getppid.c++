#include <iostream>
#include <sys/types.h>
#include <unistd.h>
using namespace std;
pid_t pid;
int main(){
    
    cout<<"the main program"<<getpid()<<endl;
    pid = fork();
    if (pid<0)
        cout<<"\nError: process failed to create";
    else if (pid==0)//chiled proccess
    {
        cout<<"\nChiled process with id: "<<getpid()<<"\n parent process id"<<getppid();
    }
    else //parent process 
        cout<<"parent process with id: "<<getpid();
    
    cout<<"the main program at end"<<getpid()<<endl;
    return 1; 
    
}
