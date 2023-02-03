import os
import datetime
import random

def fileing(i):
    with open("Readme.md", "w") as file:
        file.write("\n ## Hack Github Commit \n ### Watch video <a href=\"https://www.youtube.com/channel/UCelbvkWLSOj8eQjDd79ZN9g\">here</a> \n {} \n".format(i))

def load():
    start_date = datetime.date(2023, 1, 1)
    end_date = datetime.date(2023, 12, 21)
    delta = datetime.timedelta(days=1)

    # Randomly decide active and inactive months.
    active_months = random.sample(range(1, 13), random.randint(6, 9))

    while start_date <= end_date:
        if start_date.month in active_months:
            # Randomly decide whether to commit on this day within active months.
            commit_today = random.choice([True] * 3 + [False] * 2)  # Higher chance of committing

            if commit_today:
                # Varying number of commits for the day.
                num_commits = random.choices([0, 1, 2, 3, 4, 5], weights=[10, 40, 30, 10, 5, 5], k=1)[0]
                for _ in range(num_commits):
                    random_time = datetime.time(random.randint(0, 23), random.randint(0, 59), random.randint(0, 59))
                    random_date = datetime.datetime.combine(start_date, random_time)
                    mydate = random_date.strftime('%a %d %b %Y')
                    print(mydate)
                    fileing(mydate)
                    os.system("git add .")
                    os.system(f"git commit --date=\"{random_date.strftime('%c')}\" -m 'hack-git-commit'")
        else:
            print(f"No commits in month: {start_date.month}")

        start_date += delta

load()
os.system("git push -f origin example")
