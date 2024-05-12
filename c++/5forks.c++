#include <iostream>
#include <sys/types.h>
#include <unistd.h>
using namespace std;
pid_t pid;
int main(){
   
    pid_t pid = fork();
    pid = fork();
    pid =fork();
    if(pid==0){
    fork();
    }
    fork();
}
